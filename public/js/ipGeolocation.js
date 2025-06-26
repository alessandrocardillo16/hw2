fetch("/hw2/public/ip_geolocation")
    .then(onResponse)
    .then(onJson)
    .catch(onError);

function onResponse(response) {
    return response.json();
}

function onJson(json) {
    const userFlag = document.querySelector(".user-flag");
    if (json?.flag?.emoji) {
        userFlag.textContent = json.flag.emoji;
        userFlag.classList.remove("hidden");
    }
}

function onError(params) {
    console.log("Error fetching data:", params);
}
