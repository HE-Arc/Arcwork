async function getData(url) {
    let request = await fetch(url)
    let data = await request.json()
    if (request.ok) {
        return data
    } else {
        throw (new Error());
    }
}


function test() {
    console.log("test")
}

export { getData, test }