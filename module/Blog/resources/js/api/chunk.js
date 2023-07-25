import request from "@/utils/request";

export function type(data) {
    return request({
        url: "/blog/chunk/type",
        method: "get",
        params:data,
    });
}
export function store(data) {
    return request({
        url: "/blog/chunk",
        method: "post",
        data,
    });
}

export function relationship(data) {
    return request({
        url: "/blog/chunk/relationship",
        method: "post",
        data,
    });
}

