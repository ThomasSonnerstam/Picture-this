"use strict";

const likes = document.querySelectorAll(".reactions");

console.log(likes);

likes.forEach(like => {
    like.addEventListener("submit", e => {
        e.preventDefault();
        const formData = new FormData(like);

        fetch("http://localhost:8000/app/posts/reactions.php", {
            method: "POST",
            body: formData
        })
            .then(response => {
                return response.json();
            })
            .then(json => {
                const likeBtn = e.target.querySelector("button .like-image");
                likeBtn.src = `/assets/images/${json.src}`;
            })
            .catch(error => {
                console.error("Error:", error);
            });
    });
});
