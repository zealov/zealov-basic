import request from "@/utils/request";
export function index(data) {
    return request({
        url: "/blog/config",
        method: "get",
        params: data,
    });
}
export function group(data) {
    return request({
        url: "/blog/config/group",
        method: "get",
        params: data,
    });
}
export function store(data) {
    return request({
        url: "/blog/config",
        method: "post",
        data,
    });
}
export function update(id, data) {
    return request({
        url: "/blog/config/" + id,
        method: "put",
        data,
    });
}


export function show(id) {
    return request({
        url: "/blog/config/" + id,
        method: "get",
    });
}
