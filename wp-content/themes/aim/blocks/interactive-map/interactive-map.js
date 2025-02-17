// Define states
const statesArray = {
  "01": "AL",
  "02": "AK",
  "04": "AZ",
  "05": "AR",
  "06": "CA",
  "08": "CO",
  "09": "CT",
  10: "DE",
  12: "FL",
  13: "GA",
  15: "HI",
  16: "ID",
  17: "IL",
  18: "IN",
  19: "IA",
  20: "KS",
  21: "KY",
  22: "LA",
  23: "ME",
  24: "MD",
  25: "MA",
  26: "MI",
  27: "MN",
  28: "MS",
  29: "MO",
  30: "MT",
  31: "NE",
  32: "NV",
  33: "NH",
  34: "NJ",
  35: "NM",
  36: "NY",
  37: "NC",
  38: "ND",
  39: "OH",
  40: "OK",
  41: "OR",
  42: "PA",
  44: "RI",
  45: "SC",
  46: "SD",
  47: "TN",
  48: "TX",
  49: "UT",
  50: "VT",
  51: "VA",
  53: "WA",
  54: "WV",
  55: "WI",
  56: "WY",
};

// Define color palette
const colors = {
  white: "#ECF1FB",
  lightBlue: "#C2D3F2",
  blue: "#174FB6",
  darkBlue: "#001B4D",
  lightOrange: "#FFC36F",
  orange: "#FF9E17",
};

// Helper function to convert state FIPS ID to two-letter code
function getStateCodeFromId(id) {
  return statesArray[id.padStart(2, "0")];
}

function map(mapData) {
  const width = 975,
    height = 610;

  // Get the locations and states data from the DOM
  const mapElement = document.getElementById("map");
  const locations = JSON.parse(mapElement.dataset.locations || "[]");
  const highlightedStates = JSON.parse(mapElement.dataset.states || "[]");
  const highlightedStatesArray = Object.values(highlightedStates);

  const svg = d3
    .select("#map")
    .append("svg")
    .attr("width", width)
    .attr("height", height)
    .attr("viewBox", [0, 0, 975, 610])
    .attr("style", "width: 100%; height: auto; height: intrinsic;");

  // Create the US boundary
  svg
    .append("g")
    .append("path")
    .datum(topojson.feature(mapData, mapData.objects.nation))
    .attr("d", d3.geoPath());

  // Create the state boundaries with conditional coloring
  const states = svg
    .append("g")
    .attr("stroke", colors.white)
    .selectAll("path")
    .data(topojson.feature(mapData, mapData.objects.states).features)
    .join("path")
    .attr("fill", (d) => {
      // Get the state ID and convert it to the two-letter code
      const stateId = d.id;
      const stateCode = getStateCodeFromId(stateId);
      return highlightedStatesArray.includes(stateCode)
        ? colors.lightBlue
        : colors.white;
    })
    .attr("vector-effect", "non-scaling-stroke")
    .attr("d", d3.geoPath());

  // Add location markers with proper projection
  const projection = d3.geoAlbersUsa().scale(1300).translate([487.5, 305]);

  // At the start of your map function, validate the location data
  const validLocations = locations
    .map((loc) => ({
      ...loc,
      longitude: parseFloat(loc.longitude),
      latitude: parseFloat(loc.latitude),
    }))
    .filter(
      (loc) =>
        !isNaN(loc.longitude) &&
        !isNaN(loc.latitude) &&
        loc.longitude >= -180 &&
        loc.longitude <= 180 &&
        loc.latitude >= -90 &&
        loc.latitude <= 90,
    );

  // Create a group for the markers
  const markers = svg.append("g").attr("class", "markers");

  // Create a group for labels that will be shown/hidden on click
  const labels = svg.append("g").attr("class", "labels");

  // Create a group for the selected marker icon
  const selectedIcons = svg.append("g").attr("class", "selected-icons");

  let activeMarker = null;
  let activeIcon = null;
  let activeButton = null;

  // Add this function to handle marker/location selection
  function selectLocation(index) {
    const d = validLocations[index];

    // Reset previous active marker and state
    if (activeMarker) {
      activeMarker.attr("fill", colors.blue);
      states.each(function (state) {
        d3.select(this).attr(
          "fill",
          highlightedStatesArray.includes(getStateCodeFromId(state.id))
            ? colors.lightBlue
            : colors.white,
        );
      });
    }

    // Reset previous button styling
    if (activeButton) {
      activeButton.classList.remove("active");
    }

    // Remove previous selected icon
    if (activeIcon) {
      activeIcon.remove();
    }

    // Update button states
    activeButton = document.querySelector(
      `.interactive-map__location-button[data-index="${index}"]`,
    );
    if (activeButton) {
      activeButton.classList.add("active");
    }

    // Find and activate the new marker
    markers.selectAll("circle").each(function (md, i) {
      if (i === index) {
        activeMarker = d3.select(this);
        activeMarker.attr("fill", colors.orange);

        // Add selected icon with animation
        const coords = projection([d.longitude, d.latitude]);
        if (coords) {
          activeIcon = selectedIcons
            .append("image")
            .attr("href", "/wp-content/themes/aim/assets/icons/map-black.svg")
            .attr("width", 41)
            .attr("height", 41)
            .attr("transform", `translate(${coords[0]},${coords[1]}) scale(0)`);

          activeIcon
            .transition()
            .duration(300)
            .attr(
              "transform",
              `translate(${coords[0] - 20.5},${coords[1] - 31}) scale(1)`,
            );
        }
      }
    });

    // Highlight the state
    states.each(function (state) {
      const stateCode = getStateCodeFromId(state.id);
      if (stateCode === d.state) {
        d3.select(this).attr("fill", colors.lightOrange);
      }
    });

    // Update labels
    labels.selectAll("text").remove();
    const coords = projection([d.longitude, d.latitude]);
    if (coords) {
      labels
        .append("text")
        .text(`${d.city}, ${d.state}`)
        .attr("font-size", "20px")
        .attr("fill", colors.darkBlue)
        .attr(
          "font-family",
          "'Stabil Grotesk', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif",
        )
        .attr("font-weight", "400")
        .attr("alignment-baseline", "middle")
        .each(function () {
          const coords = projection([d.longitude, d.latitude]);
          const textWidth = this.getComputedTextLength();
          let xOffset;
          if (d.longitude > -80) {
            xOffset = -textWidth - 12;
          } else {
            xOffset = 12;
          }
          d3.select(this).attr(
            "transform",
            `translate(${coords[0] + xOffset}, ${coords[1]})`,
          );
        });
    }
  }

  // Add this function after the selectLocation function
  function clearSelection() {
    // Reset active marker
    if (activeMarker) {
      activeMarker.attr("fill", colors.blue);
      states.each(function (state) {
        d3.select(this).attr(
          "fill",
          highlightedStatesArray.includes(getStateCodeFromId(state.id))
            ? colors.lightBlue
            : colors.white,
        );
      });
    }

    // Reset button styling
    if (activeButton) {
      activeButton.classList.remove("active");
    }

    // Remove selected icon
    if (activeIcon) {
      activeIcon.remove();
    }

    // Clear labels
    labels.selectAll("text").remove();

    // Reset all variables
    activeMarker = null;
    activeIcon = null;
    activeButton = null;
  }

  // Add the location markers
  markers
    .selectAll("circle")
    .data(validLocations)
    .join("circle")
    .attr("transform", (d) => {
      const coords = projection([d.longitude, d.latitude]);
      return coords ? `translate(${coords[0]},${coords[1]})` : null;
    })
    .attr("r", 7)
    .attr("fill", colors.blue)
    .attr("stroke-width", 0)
    .style("display", (d) => {
      const coords = projection([d.longitude, d.latitude]);
      return coords ? "inline" : "none";
    })
    .style("cursor", "pointer")
    .on("click", function (event, d) {
      const index = validLocations.indexOf(d);
      selectLocation(index);
    });

  // Modify the button event listeners at the end of the map function
  document
    .querySelectorAll(".interactive-map__location-button")
    .forEach((button) => {
      // Add mouseenter handler for hover effects
      button.addEventListener("mouseenter", (event) => {
        const index = parseInt(event.target.dataset.index);
        selectLocation(index);
      });

      // Add mouseleave handler to clear selection
      button.addEventListener("mouseleave", () => {
        clearSelection();
      });
    });
}

window.addEventListener("DOMContentLoaded", async (event) => {
  const res = await fetch(
    `https://cdn.jsdelivr.net/npm/us-atlas@3/states-albers-10m.json`,
  );
  const mapJson = await res.json();
  map(mapJson);
});
