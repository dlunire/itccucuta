// upload.ts
export type UploadOptions = {
    field?: string;
    url: string;
    onProgress?: (progress: number) => void;
    onSuccess?: (response: unknown) => void;
    onError?: (error: unknown) => void;
};

export function uploadFile(node: HTMLInputElement, options: UploadOptions) {
    const handleChange = () => {
        const file = node.files?.[0];
        if (!file) return;

        const formData = new FormData();
        formData.append(options.field ?? "file", file);

        const xhr = new XMLHttpRequest();
        xhr.open("POST", options.url, true);

        progress(options, xhr);

        xhr.onload = () => {
            try {
                const response = JSON.parse(xhr.responseText);
                options.onSuccess?.(response);
            } catch {
                options.onSuccess?.(xhr.responseText);
            }
        };

        xhr.onerror = () => options.onError?.(new Error("Error de red"));
        xhr.ontimeout = () => options.onError?.(new Error("Timeout"));

        xhr.send(formData);
    };

    node.addEventListener("change", handleChange);

    return {
        destroy() {
            node.removeEventListener("change", handleChange);
        }
    };
}

/**
 * Muestra el progreso de carga de archivo al servidor.
 * 
 * @param options Opciones
 * @param xhr Objeto XMLHttpRequest
 * @returns 
 */
function progress(options: UploadOptions, xhr: XMLHttpRequest) {
    if (!(options.onProgress && xhr.upload)) return;

    xhr.upload.onprogress = function (event: ProgressEvent<EventTarget>) {
        if (!(event.lengthComputable)) return;
        const progress = (event.loaded / event.total) * 100;
        options.onProgress?.(progress);
    };
}