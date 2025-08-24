<!DOCTYPE html>
<html lang="en">
<x-head />
@livewireStyles


<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <x-navbar />
            <x-sidebar />
            <div class="main-content">
                @yield('content');
                {{ @$slot }}
                @livewireScripts
            </div>
        </div>
    </div>
    <x-script />

    @stack('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const lazyLoadImages = () => {
                const images = document.querySelectorAll('img.lazy:not([data-lazy="true"])');
                images.forEach(img => {
                    img.setAttribute("data-src", img.src);
                    img.src = "loader-img.gif";
                    img.setAttribute("data-lazy", "true");
                });

                const observerOptions = {
                    rootMargin: "0px",
                    threshold: 0.1
                };

                const observer = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.src = img.dataset.src;
                            img.onload = () => img.classList.add("loaded");
                            observer.unobserve(img);
                        }
                    });
                }, observerOptions);

                images.forEach(image => observer.observe(image));
            };

            lazyLoadImages();
        });
        async function uploadFile(fileInputId, modelName, id) {
            console.log(`Uploading file from input: ${fileInputId}, model: ${modelName}, id: ${id}`);
            const fileInput = document.getElementById(fileInputId);
            const file = fileInput.files[0];

            if (!file) {
                return {
                    success: false,
                    message: 'No file selected.',
                };
            }

            const formData = new FormData();
            formData.append('file', file);
            formData.append('model', modelName);
            formData.append('id', id);

            try {
                const response = await fetch('/models/file', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: formData,
                });
                const result = await response.json();
                return result;
            } catch (error) {

                console.error('File upload failed:', error);
                return {
                    success: false,
                    message:error ,
                };
            }
        }

        //check 1x1 ratio and convert it
 function checkAndConvertImage(file, callback) {
    const reader = new FileReader();

    reader.onload = function (event) {
        const img = new Image();
        img.onload = function () {
            const width = img.width;
            const height = img.height;

            if (width === height) {
                // Image is 1:1, convert to base64 bytes
                const canvas = document.createElement('canvas');
                canvas.width = width;
                canvas.height = height;
                const ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0, width, height);

                // Get base64 string
                const base64 = canvas.toDataURL(file.type); // e.g., image/png
                const byteString = atob(base64.split(',')[1]);
                const byteArray = new Uint8Array(byteString.length);
                for (let i = 0; i < byteString.length; i++) {
                    byteArray[i] = byteString.charCodeAt(i);
                }

                callback({
                    success: true,
                    ratio: '1x1',
                    bytes: byteArray,
                    base64: base64,
                    message: 'Image is 1:1 and converted to bytes.'
                });
            } else {
                callback({
                    success: false,
                    ratio: `${width}x${height}`,
                    message: 'Image is not 1:1 ratio.'
                });
            }
        };
        img.onerror = function () {
            callback({
                success: false,
                message: 'Invalid image file.'
            });
        };
        img.src = event.target.result;
    };

    reader.onerror = function () {
        callback({
            success: false,
            message: 'Failed to read file.'
        });
    };

    reader.readAsDataURL(file);
}

    </script>

</body>
</html>
