import request from "@/utils/request";

export function category(data) {
    return request({
        url: "/blog/category",
        method: "get",
        params: data,
    });
}

export function create(data) {
    return request({
        url: "/blog/category",
        method: "post",
        data,
    });
}

export function updateSort(data) {
    return request({
        url: "/blog/category/updateSort",
        method: "post",
        data,
    });
}

export function show(id) {
    return request({
        url: "/blog/category/" + id,
        method: "get",
    });
}

export function update(id, data) {
    return request({
        url: "/blog/category/" + id,
        method: "put",
        data,
    });
}

export function destroy(id) {
    return request({
        url: "/blog/category/" + id,
        method: "delete",
    });
}
