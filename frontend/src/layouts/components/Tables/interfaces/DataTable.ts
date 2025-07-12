export type RegisterType = string | number | boolean | null | undefined;

export interface Column {
    [x: string]: string
}
export interface Register {
    [x: string]: RegisterType;
}
export interface DataTable {
    columns: Column;
    records: Register[];
}