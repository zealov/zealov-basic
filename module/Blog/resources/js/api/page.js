import request from "@/utils/request";
export function index(data) {
    return request({
        url: "/blog/page",
        method: "get",
        params: data,
    });
}
export function all(data) {
    return request({
        url: "/blog/page/all",
        method: "get",
        params: data,
    });
}

export function store(data) {
    return request({
        url: "/blog/page",
        method: "post",
        data,
    });
}
export function update(id, data) {
    return request({
        url: "/blog/page/" + id,
        method: "put",
        data,
    });
}

export function destroy(id) {
    return request({
        url: "/blog/page/" + id,
        method: "delete",
    });
}
export function show(id) {
    return request({
        url: "/blog/page/" + id,
        method: "get",
    });
}
