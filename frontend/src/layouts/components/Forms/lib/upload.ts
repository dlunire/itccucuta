import { getURLBase } from "./request";

export type OnProgress = (progress: number, done: boolean) => void;
export type OnLoaded = (done: boolean) => void;

export function upload(form: HTMLFormElement, onprogress: OnProgress | undefined = undefined, onloaded: OnLoaded | undefined = undefined): void {
    if (!(form instanceof HTMLFormElement)) {
        throw new Error("Se esperaba un formulario como argumento en el parámetro «form»");
    }

    const action: string | null = form.getAttribute('action');
    if (typeof action != "string") return;

    const url: string = `${getURLBase()}${action}`;
    const xhr = new XMLHttpRequest();
    xhr.open('POST', url);

    xhr.upload.onprogress = function (event: ProgressEvent): void {
        if (typeof onprogress != "function") return;
        const loaded: number = (event.loaded / event.total) * 100;
        onprogress(loaded, event.loaded == event.total);
    }

    xhr.upload.onload = function (event: ProgressEvent): void {
        if (typeof onloaded != "function") return;
        onloaded(event.loaded == event.total);
    }

    xhr.upload.onerror = function (event: ProgressEvent): void {
        console.error("Subida fallida:", event);
    };

    xhr.upload.onabort = function (event: ProgressEvent): void {
        console.warn("Subida abortada:", event);
    }

    xhr.send(new FormData(form));
}