import Viewer from 'viewerjs';
import 'viewerjs/dist/viewer.css';

function initPhotoGalleries() {
    document.querySelectorAll('[data-photo-gallery]').forEach((gallery) => {
        if (gallery.dataset.viewerInitialized) {
            return;
        }

        gallery.dataset.viewerInitialized = 'true';

        gallery.querySelectorAll('a img').forEach((img) => {
            img.addEventListener('click', (event) => event.preventDefault());
        });

        new Viewer(gallery, {
            backdrop: true,
            initialCoverage: window.innerWidth < 640 ? 1 : 0.6,
            title: false,
            toolbar: {
                zoomIn: true,
                zoomOut: true,
                oneToOne: false,
                reset: false,
                prev: true,
                play: false,
                next: true,
                rotateLeft: true,
                rotateRight: true,
                flipHorizontal: false,
                flipVertical: false,
            },
        });
    });
}

document.addEventListener('DOMContentLoaded', initPhotoGalleries);
document.addEventListener('livewire:navigated', initPhotoGalleries);
