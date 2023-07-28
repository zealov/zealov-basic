import request from "@/utils/request";
export function index(data) {
    return request({
        url: "/blog/file",
        method: "get",
        params: data,
    });
}

export function store(data){
    return request({
        url: "/blog/file",
        method: "post",
        data,
    });
}
export function show(id) {
    return request({
        url: "/blog/file/" + id,
        method: "get",
    });
}
export function update(id, data) {
    return request({
        url: "/blog/file/" + id,
        method: "put",
        data,
    });
}
