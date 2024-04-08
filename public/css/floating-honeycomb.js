function floatingImagesComponent() {
    return {
        mouseX: 0,
        mouseY: 0,
        init() {
            // Listen for global mouse position changes
            this.$root.$watch("mouseX", (value) => (this.mouseX = value));
            this.$root.$watch("mouseY", (value) => (this.mouseY = value));
        },
        getTransform(index) {
            // Calculate and return the transform style based on index or any specific logic
            const speed = [15, 30, 17, 18, 20, 20, 30, 25, 8][index];
            return `transform: translate3d(${this.mouseX / -speed}px, ${
                this.mouseY / -speed
            }px, 0)`;
        },
    };
}
