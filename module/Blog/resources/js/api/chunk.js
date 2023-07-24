import request from "@/utils/request";

export function type(data) {
    return request({
        url: "/blog/chunk/type",
        method: "get",
        data,
    });
}
export function store(data) {
    return request({
        url: "/blog/chunk",
        method: "post",
        data,
    });
}
