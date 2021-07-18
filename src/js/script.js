

document.querySelector("#candidate-form-open").addEventListener("click", () => {
    const candidate_form = document.querySelector("#candidate-form");
    candidate_form.classList.remove("hidden");
    candidate_form.classList.add("flex");
})

document.querySelector("#candidate-form-close").addEventListener("click", () => {
    const candidate_form = document.querySelector("#candidate-form");
    candidate_form.classList.remove("flex");
    candidate_form.classList.add("hidden");
})