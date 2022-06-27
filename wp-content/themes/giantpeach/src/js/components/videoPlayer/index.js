class VideoPlayer {
    constructor(node) {
      this.player = node;
      this.video = this.player.querySelector('video');

      this.play();

      this.addListeners();
    }

    addListeners() {
      this.player.querySelector('.video-player__play').addEventListener('click', this.play.bind(this));
      // this.player.querySelector('.video-player__pause').addEventListener('click', this.pause.bind(this));
    }

    play() {
      this.player.classList.add('playing');
      this.video.play();
    }

    pause() {
      this.player.classList.remove('playing');
      this.video.pause();
    }
}

export default VideoPlayer;
