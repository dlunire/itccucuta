export interface ResponseServer {
    code: number;
    route?: string;
    message: string
}

export interface UploadedFile {
    url: string;
    preview: string;
    type: string;
    bytes: number;
    format: string;
    size: string;
    private: boolean;
}
