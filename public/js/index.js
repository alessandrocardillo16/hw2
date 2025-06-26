fetch("/hw2/public/home/cards")
    .then(onResponse)
    .then(createCards)
    .catch(onError);

function createCards(data) {
    const container = document.querySelector(".home-card-group.container");

    if (!container) {
        console.error("Container per le home card non trovato.");
        return;
    }
    container.innerHTML = "";
    for (let index = 0; index < data.length; index++) {
        const cardData = data[index];
        const cardElement = document.createElement("a");
        cardElement.className =
            index === 0
                ? "home-card home-card-a"
                : `home-card home-card-secondary home-card-${String.fromCharCode(
                      98 + index - 1
                  )}`;
        cardElement.href = cardData.href;
        const imgElement = document.createElement("img");
        imgElement.className = "home-card-background";
        imgElement.src = cardData.img_src;
        imgElement.alt = cardData.title;
        cardElement.appendChild(imgElement);

        if (index === 0) {
            const titleElement = document.createElement("h1");
            titleElement.className = "home-card-title";
            titleElement.textContent = cardData.title;

            const buttonElement = document.createElement("div");
            buttonElement.className =
                "contained-button contained-button-red home-card-button";
            buttonElement.textContent = "Bundle & Save";

            cardElement.appendChild(titleElement);
            cardElement.appendChild(buttonElement);
        } else {
            const titleElement = document.createElement("h2");
            titleElement.className = "home-card-secondary-title";
            titleElement.textContent = cardData.title;

            cardElement.appendChild(titleElement);
        }

        container.appendChild(cardElement);
    }
}

function createContentCard(item) {
    const card = document.createElement("div");
    card.className = "content-card";
    card.dataset.articleId = item.id || "";

    const preview = document.createElement("div");
    preview.className = "content-card-preview";
    const img = document.createElement("img");
    img.className = "content-card-image";
    img.src = item.imgSrc || "";
    img.alt = "";
    preview.appendChild(img);

    const contentContainer = document.createElement("div");
    contentContainer.className = "content-container";

    const title = document.createElement("a");
    title.className = "content-card-title";
    title.href = "/hw2/public/articles/" + item.id;
    title.textContent = item.title || "Article Title Placeholder";
    contentContainer.appendChild(title);

    const meta = document.createElement("div");
    meta.className = "content-card-meta";
    const dateSpan = document.createElement("span");
    dateSpan.className = "article-publish-date";
    dateSpan.textContent = item.publishDate || "3 days ago";
    const byText = document.createTextNode(" by ");
    const authorSpan = document.createElement("span");
    authorSpan.className = "article-author";
    authorSpan.textContent = item.author || "Utente";
    meta.appendChild(dateSpan);
    meta.appendChild(byText);
    meta.appendChild(authorSpan);
    contentContainer.appendChild(meta);

    const descriptionDiv = document.createElement("div");
    descriptionDiv.className = "content-description";
    descriptionDiv.textContent =
        item.description ||
        "Lorem ipsum dolor sit amet consectetur adipisicing elit.";
    contentContainer.appendChild(descriptionDiv);

    const readMore = document.createElement("a");
    readMore.className = "content-more";
    readMore.href = title.href = "/hw2/public/articles/" + item.id;
    readMore.textContent = "Read More";
    contentContainer.appendChild(readMore);

    const likesContainer = document.createElement("div");
    likesContainer.className = "content-card-likes";
    const likes = document.createElement("div");
    likes.className = "article-likes";
    likes.textContent = ` ${item.likes_count || 0}`;
    likes.setAttribute("data-article-id", item.id);
    likesContainer.appendChild(likes);

    const likesIcon = document.createElement("img");
    likesIcon.className = "article-likes-icon";
    likesIcon.src = "/hw2/public/assets/icons/heart_empty.svg";
    likesIcon.setAttribute("data-article-id", item.id);

    fetch("/hw2/public/articles/check", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: "article_id=" + encodeURIComponent(item.id),
    })
        .then(onResponse)
        .then(onJsonLike);

    likesIcon.addEventListener("click", onLikeIconClick);

    likesContainer.appendChild(likesIcon);
    contentContainer.appendChild(likesContainer);

    card.appendChild(preview);
    card.appendChild(contentContainer);

    return card;
}

function onLikeIconClick(event) {
    const articleId = event.currentTarget.getAttribute("data-article-id");
    addLike(articleId);
}

let articlesOffset = 0;
const articlesLimit = 8;

var appendGlobal = false;

function loadArticles(offset, append) {
    appendGlobal = append;
    fetch("/hw2/public/articles/" + offset + "/" + articlesLimit)
        .then(onResponse)
        .then(onJsonArticles)
        .catch(onError);
}

function onJsonArticles(data) {
    var articles = data.articles !== null ? data.articles : [];

    var topContainer = document.querySelector(".content-card-container");

    if (articles.length > 0 && !appendGlobal) {
        var homeBody = document.querySelector(".home-body.container");
        if (homeBody) {
            homeBody.innerHTML = "";

            var articleDiv = document.createElement("div");
            articleDiv.className = "home-body-article";

            var titleA = document.createElement("a");
            titleA.className = "article-title";
            titleA.href = "/hw2/public/articles/" + articles[0].id;
            titleA.textContent = articles[0].title || "";

            var extrasDiv = document.createElement("div");
            extrasDiv.className = "home-body-article-extras";

            var dateSpan = document.createElement("span");
            dateSpan.className = "article-publish-date";
            dateSpan.textContent = articles[0].publishDate || "";

            var byText = document.createTextNode(" by ");

            var authorSpan = document.createElement("span");
            authorSpan.className = "article-author";
            authorSpan.textContent = articles[0].author || "";

            extrasDiv.appendChild(dateSpan);
            extrasDiv.appendChild(byText);
            extrasDiv.appendChild(authorSpan);

            var descDiv = document.createElement("div");
            descDiv.className = "article-description";
            descDiv.textContent = articles[0].description || "";

            var moreA = document.createElement("a");
            moreA.className = "article-more";
            moreA.href = "/hw2/public/articles/" + articles[0].id;
            moreA.textContent = "read more";

            articleDiv.appendChild(titleA);
            articleDiv.appendChild(extrasDiv);
            articleDiv.appendChild(descDiv);
            articleDiv.appendChild(moreA);

            var likesContainer = document.createElement("div");
            likesContainer.className = "content-card-likes";
            var likes = document.createElement("div");
            likes.className = "article-likes";
            likes.textContent = articles[0].likes_count || 0;
            likes.setAttribute("data-article-id", articles[0].id);
            likesContainer.appendChild(likes);

            var likesIcon = document.createElement("img");
            likesIcon.className = "article-likes-icon";
            likesIcon.src = "/hw2/public/assets/icons/heart_empty.svg";
            likesIcon.setAttribute("data-article-id", articles[0].id);

            fetch("/hw2/public/articles/check", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: "article_id=" + encodeURIComponent(articles[0].id),
            })
                .then(onResponse)
                .then(onJsonLike);

            likesIcon.addEventListener("click", onLikeIconClick);

            likesContainer.appendChild(likesIcon);
            articleDiv.appendChild(likesContainer);

            var imageDiv = document.createElement("div");
            imageDiv.className = "home-body-image";
            if (articles[0].imgSrc) {
                var img = document.createElement("img");
                img.src = articles[0].imgSrc;
                img.alt = "";
                img.className = "home-body-img";
                imageDiv.appendChild(img);
            }

            homeBody.appendChild(articleDiv);
            homeBody.appendChild(imageDiv);
        }
    }

    if (!appendGlobal) {
        topContainer.innerHTML = "";

        var firstCardsContainer = document.createElement("div");
        firstCardsContainer.className = "top-cards-container";

        for (var i = 1; i < Math.min(3, articles.length); i++) {
            var item = articles[i];
            var newCard = createContentCard(item);
            firstCardsContainer.appendChild(newCard);
        }

        topContainer.appendChild(firstCardsContainer);

        for (var i = 3; i < articles.length; i++) {
            var item = articles[i];
            var newCard = createContentCard(item);
            topContainer.appendChild(newCard);
        }
    } else {
        for (var i = 0; i < articles.length; i++) {
            var item = articles[i];
            var newCard = createContentCard(item);
            if (topContainer) {
                topContainer.appendChild(newCard);
            }
        }
    }

    articlesOffset += articles.length;

    if (articles.length < articlesLimit) {
        document.querySelector(".see-more").classList.add("hidden");
    }
}

function onJsonLike(data) {
    if (!data.article_id) return;
    const likesIcons = document.querySelectorAll(".article-likes-icon");
    for (const likesIcon of likesIcons) {
        if (
            likesIcon.getAttribute("data-article-id") ===
            String(data.article_id)
        ) {
            if (data.liked) {
                likesIcon.src = "/hw2/public/assets/icons/heart_full.svg";
                likesIcon.classList.add("liked");
            } else {
                likesIcon.src = "/hw2/public/assets/icons/heart_empty.svg";
                likesIcon.classList.remove("liked");
            }
        }
    }
}

loadArticles(0, false);

document.querySelector(".see-more").addEventListener("click", OnSeeMoreClick);

function OnSeeMoreClick(event) {
    event.preventDefault();
    loadArticles(articlesOffset, true);
}

function addLike(articleId) {
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    fetch("/hw2/public/articles/like", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
            "X-CSRF-TOKEN": csrfToken,
        },
        body: "article_id=" + encodeURIComponent(articleId),
    })
        .then(onResponse)
        .then(onJsonLikeUpdate)
        .catch(onError);
}

function onJsonLikeUpdate(data) {
    var likesIcon;
    var likesElement;
    if (!data.success && !data.authenticated) {
        window.location.href = "/hw2/public/login";
        return;
    }
    if (!data.article_id) return;
    const likesIcons = document.querySelectorAll(".article-likes-icon");
    for (const item of likesIcons) {
        if (item.getAttribute("data-article-id") === String(data.article_id)) {
            likesIcon = item;
            break;
        }
    }
    const likesElements = document.querySelectorAll(".article-likes");
    for (const item of likesElements) {
        if (item.getAttribute("data-article-id") === String(data.article_id)) {
            likesElement = item;
            break;
        }
    }
    if (!likesIcon || !likesElement) {
        console.log(
            "Elemento non trovato per l'ID dell'articolo:",
            data.article_id
        );

        return;
    }
    if (data.success && data.likes_count !== undefined) {
        likesElement.textContent = data.likes_count;
        if (data.liked) {
            likesIcon.src = "/hw2/public/assets/icons/heart_full.svg";
            likesIcon.classList.add("liked");
        } else {
            likesIcon.src = "/hw2/public/assets/icons/heart_empty.svg";
            likesIcon.classList.remove("liked");
        }
    }
}

function onResponse(response) {
    return response.json();
}

function onError(error) {
    console.error("Errore:", error);
}
