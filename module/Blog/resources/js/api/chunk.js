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
export function update(id, data) {
    return request({
        url: "/blog/chunk/" + id,
        method: "put",
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

export function destroy(id) {
    return request({
        url: "/blog/chunk/" + id,
        method: "delete",
    });
}
