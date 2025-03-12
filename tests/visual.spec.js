const { test, expect } = require('@playwright/test');
const fs = require('fs');
const path = require('path');

// Environment variable to control updating reference screenshots
const updateSnapshots = process.env.UPDATE_SNAPSHOTS === 'true';

// Array of pages to test
const pagePaths = [
  '/',
  '/admissions/financing',
];

// Ensure screenshots directories exist
const screenshotsDir = path.join(process.cwd(), 'screenshots');
const referenceScreenshotsDir = path.join(process.cwd(), 'reference-screenshots');

// Create screenshots directory if it doesn't exist
if (!fs.existsSync(screenshotsDir)) {
  fs.mkdirSync(screenshotsDir);
}

// Create reference screenshots directory if it doesn't exist
if (!fs.existsSync(referenceScreenshotsDir)) {
  fs.mkdirSync(referenceScreenshotsDir);
}

test.describe('Visual Regression Tests', () => {
  // Run before each test
  test.beforeEach(async ({ page }) => {
    // Set viewport size for consistency
    await page.setViewportSize({ width: 1280, height: 720 });
  });

  // Generate test for each page
  for (const pagePath of pagePaths) {
    test(`Visual regression test for ${pagePath}`, async ({ page }) => {
      // Navigate to the page
      await page.goto(pagePath);
      
      // Wait for network to be idle
      await page.waitForLoadState('networkidle');
      
      // Generate filename from path
      const filename = pagePath === '/' 
        ? 'homepage' 
        : pagePath.replace(/\//g, '-').replace(/^-/, '');
      
      // Define screenshot paths
      const timestamp = new Date().toISOString().replace(/[:.]/g, '-');
      const actualScreenshotPath = path.join(
        screenshotsDir,
        `${filename}-${timestamp}.png`
      );
      const referenceScreenshotPath = path.join(
        referenceScreenshotsDir,
        `${filename}.png`
      );
      
      // Capture full page screenshot
      await page.screenshot({
        path: actualScreenshotPath,
        fullPage: true
      });
      
      // Verify screenshot was created
      expect(fs.existsSync(actualScreenshotPath)).toBeTruthy();
      console.log(`Screenshot saved: ${actualScreenshotPath}`);
      
      // If UPDATE_SNAPSHOTS is true, update the reference screenshot
      if (updateSnapshots) {
        fs.copyFileSync(actualScreenshotPath, referenceScreenshotPath);
        console.log(`Reference screenshot updated: ${referenceScreenshotPath}`);
      } 
      // Otherwise compare with reference screenshot
      else {
        // Check if reference screenshot exists
        if (!fs.existsSync(referenceScreenshotPath)) {
          console.log(`Reference screenshot doesn't exist. Creating: ${referenceScreenshotPath}`);
          fs.copyFileSync(actualScreenshotPath, referenceScreenshotPath);
        }
        
        // Compare screenshots using Playwright's built-in functionality
        await expect(page).toHaveScreenshot({
          path: `${filename}.png`,
          fullPage: true,
          maxDiffPixelRatio: 0.05,  // Allow 5% of pixels to be different
        });
      } // Close else block
    }); // Close test function
  } // Close for loop
}); // Close test.describe

