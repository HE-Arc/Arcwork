const addr = "http://localhost:8000/api"

async function getData(url) {
    let request = await fetch(addr + url)
    let data = await request.json()
    if (request.ok) {
        console.log(data)
        return data
    } else {
        throw (new Error());
    }
}

async function sendData(url, params = {}, body = "") {
    let request = await fetch(addr + url + "?" + new URLSearchParams(params).toString(), {
        method: "post",
        body: JSON.stringify(body)
    })
    let result = await request.json()
    if (request.ok) {
        return result
    } else {
        throw (new Error());
    }
}



function test() {
    console.log("test")
}

export { getData, sendData, test }