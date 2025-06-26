let articlesOffset = 0;
const articlesLimit = 8;
var appendGlobal = false;

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

function onJsonArticles(data) {
    var articles = data.articles !== null ? data.articles : [];

    var topContainer = document.querySelector(".content-card-container");

    if (!appendGlobal) topContainer.innerHTML = "";

    for (var i = 0; i < articles.length; i++) {
        var item = articles[i];
        var newCard = createContentCard(item);
        if (topContainer) {
            topContainer.appendChild(newCard);
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

function onLikeIconClick(event) {
    const articleId = event.currentTarget.getAttribute("data-article-id");
    addLike(articleId);
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
    console.error("Errore durante il recupero degli articoli:", error);
}

function loadArticles(offset, append) {
    appendGlobal = append;
    fetch("/hw2/public/articles/user/" + offset + "/" + articlesLimit)
        .then(onResponse)
        .then(onJsonArticles)
        .catch(onError);
}

document.querySelector(".see-more").addEventListener("click", OnSeeMoreClick);

function OnSeeMoreClick(event) {
    event.preventDefault();
    loadArticles(articlesOffset, true);
}

loadArticles(0, false);
