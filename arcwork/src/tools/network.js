async function getData(url) {
    let request = await fetch(url)
    let data = await request.json()
    return data
}


function test() {
    console.log("test")
}

export { getData, test }