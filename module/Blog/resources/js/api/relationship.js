import request from "@/utils/request";

export function entity(data) {
    return request({
        url: "/blog/relationship/entity",
        method: "get",
        params:data,
    });
}


