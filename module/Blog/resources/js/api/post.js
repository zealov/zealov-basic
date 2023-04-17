import request from "@/utils/request";
export function index(data) {
    return request({
        url: "/blog/post",
        method: "get",
        params: data,
    });
}
export function store(data) {
    return request({
        url: "/blog/post",
        method: "post",
        data,
    });
}
export function update(id, data) {
    return request({
        url: "/blog/post/" + id,
        method: "put",
        data,
    });
}

export function destroy(id) {
    return request({
        url: "/blog/post/" + id,
        method: "delete",
    });
}
export function show(id) {
    return request({
        url: "/blog/post/" + id,
        method: "get",
    });
}
