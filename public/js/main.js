document
    .querySelector(".content-container")
    .addEventListener("click", async (e) => {
        e.preventDefault();

        if (e.target.matches(".remove-favourites")) {
            const postId = e.target
                .closest("form")
                .querySelector('[name="postId"]').value;
            const token = document.querySelector('[name="_token"]').value;

            console.log(token);

            const resp = await fetch("/", {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": token,
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ id: postId }),
            });
            console.log(resp);

            const data = await resp.json();
        }
    });
