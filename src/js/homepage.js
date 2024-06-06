function homeSection() {
  return {
    currentIndex: 1,
    images: [
      "../src/img/homepage/deluxe.jpg",
      "../src/img/homepage/executive.jpg",
    ],
    back() {
      if (this.currentIndex > 1) {
        this.currentIndex = this.currentIndex - 1;
      }
    },
    next() {
      if (this.currentIndex < this.images.length) {
        this.currentIndex = this.currentIndex + 1;
      } else if (this.currentIndex <= this.images.length) {
        this.currentIndex = this.images.length - this.currentIndex + 1;
      }
    },
  };
}
