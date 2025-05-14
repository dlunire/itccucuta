/**
 * Sube un archivo al servidor usando XMLHttpRequest.
 * 
 * @param url - Ruta destino del archivo en el servidor.
 * @param file - Archivo a subir.
 * @param fieldName - Nombre del campo en el `FormData`. Por defecto: 'file'.
 * @param onProgress - Callback para progreso de carga (opcional).
 * @returns Una promesa que resuelve con la respuesta del servidor.
 */
export function uploadFile(
    url: string,
    file: File,
    fieldName = "file",
    onProgress?: (progress: number) => void
): Promise<unknown> {
    return new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();
        const formData = new FormData();

        formData.append(fieldName, file);

        xhr.open("POST", url, true);

        // Opcional: monitorea el progreso
        if (onProgress && xhr.upload) {
            xhr.upload.onprogress = (event) => {
                if (event.lengthComputable) {
                    const progress = (event.loaded / event.total) * 100;
                    onProgress(progress);
                }
            };
        }

        // Cuando la petición finaliza
        xhr.onload = () => {
            try {
                const response = JSON.parse(xhr.responseText);
                resolve(response);
            } catch {
                resolve(xhr.responseText); // En caso de no ser JSON
            }
        };

        xhr.onerror = () => reject(new Error("Error de red"));
        xhr.ontimeout = () => reject(new Error("La solicitud ha expirado"));

        xhr.send(formData);
    });
}
