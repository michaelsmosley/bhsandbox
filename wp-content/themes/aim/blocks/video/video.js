document.addEventListener("DOMContentLoaded", function () {
  const videoComponents = document.querySelectorAll(".video-block");

  videoComponents.forEach((component) => {
    const poster = component.querySelector(".video-block__poster");
    const videoContainer = component.querySelector(
      ".video-block__video-container",
    );
    const playButton = component.querySelector(".video-block__play-button");

    if (playButton) {
      playButton.addEventListener("click", function () {
        const videoUrl = component.dataset.videoUrl;
        let embedUrl;

        // Check if it's a YouTube URL
        if (videoUrl.includes("youtube.com") || videoUrl.includes("youtu.be")) {
          const videoId = getYouTubeVideoId(videoUrl);
          embedUrl = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
        }
        // Check if it's a Vimeo URL
        else if (videoUrl.includes("vimeo.com")) {
          const { videoId, hParam } = getVimeoVideoId(videoUrl);
          embedUrl = `https://player.vimeo.com/video/${videoId}${hParam ? `?h=${hParam}&` : '?'}autoplay=1`;
        }
        // Direct video file
        else {
          const video = document.createElement("video");
          video.src = videoUrl;
          video.controls = true;
          video.autoplay = true;
          videoContainer.appendChild(video);
          poster.style.display = "none";
          videoContainer.style.display = "block";
          return;
        }

        const iframe = document.createElement("iframe");
        iframe.src = embedUrl;
        iframe.allow = "autoplay; fullscreen";
        iframe.allowFullscreen = true;

        videoContainer.appendChild(iframe);
        poster.style.display = "none";
        videoContainer.style.display = "block";
      });
    }
  });

  function getYouTubeVideoId(url) {
    const regExp =
      /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
    const match = url.match(regExp);
    return match && match[2].length === 11 ? match[2] : null;
  }

  function getVimeoVideoId(url) {
    const regex = /(?:https?:\/\/)?(?:www\.)?(?:vimeo\.com\/(?:channels\/[\w]+\/|groups\/[\w]+\/videos\/|video\/|videos\/|)|player\.vimeo\.com\/video\/)(\d+)(?:\/([a-zA-Z0-9]+))?/;
    const match = url.match(regex);
    return {
      videoId: match ? match[1] : null,
      hParam: match && match[2] ? match[2] : null
    };
  }
});
