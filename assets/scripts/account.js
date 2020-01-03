"use strict";

const avatarContainer = document.querySelector(".profile-info");
const avatar = avatarContainer.querySelector(".profile-picture");
const deleteBtn = document.querySelector(".delete-account");

// Makes the avatar image jump
avatar.addEventListener("click", () => {
    avatar.style.animation = "avatarRotate 1s";
});

// Confirmation pop up to delete account
deleteBtn.addEventListener("click", e => {
    const confirm = window.confirm(
        "Are you sure you want to delete your account?"
    );

    if (!confirm) {
        e.preventDefault();
    }
});
