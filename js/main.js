/* RETRO.GAMES — progressive enhancements only; the site works without JS. */
(function () {
  "use strict";

  // Mobile navigation toggle
  var toggle = document.querySelector(".nav-toggle");
  var nav = document.querySelector(".site-nav");
  if (toggle && nav) {
    toggle.addEventListener("click", function () {
      var open = nav.classList.toggle("is-open");
      toggle.setAttribute("aria-expanded", open ? "true" : "false");
    });
    nav.addEventListener("click", function (event) {
      if (event.target.closest("a")) {
        nav.classList.remove("is-open");
        toggle.setAttribute("aria-expanded", "false");
      }
    });
  }

  // Feedback form: send via fetch; without JS the form posts normally
  var form = document.querySelector(".feedback-form");
  if (form) {
    var status = form.querySelector(".feedback-form__status");
    var setStatus = function (text, isError) {
      status.textContent = text;
      status.classList.toggle("is-error", !!isError);
    };
    if (new URLSearchParams(window.location.search).get("sent") === "1") {
      setStatus("Thank you! Your message has been sent.");
    }
    form.addEventListener("submit", function (event) {
      if (!window.fetch) return;   // very old browser: plain form post
      event.preventDefault();
      var button = form.querySelector('button[type="submit"]');
      button.disabled = true;
      setStatus("Sending…");
      fetch(form.action, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          name: form.elements.name.value,
          email: form.elements.email.value,
          message: form.elements.message.value,
          website: form.elements.website.value,
          ts: form.elements.ts.value
        })
      })
        .then(function (response) { return response.json(); })
        .then(function (data) {
          if (data.ok) {
            form.reset();
            setStatus("Thank you! Your message has been sent.");
          } else {
            setStatus(data.error || "Sending failed, please try again later.", true);
          }
        })
        .catch(function () {
          setStatus("Sending failed, please try again later.", true);
        })
        .finally(function () {
          button.disabled = false;
        });
    });
  }

  // Scroll reveal for cards and sections
  var revealables = document.querySelectorAll("[data-reveal]");
  if ("IntersectionObserver" in window && revealables.length) {
    var observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add("is-visible");
            observer.unobserve(entry.target);
          }
        });
      },
      { rootMargin: "0px 0px -10% 0px" }
    );
    revealables.forEach(function (el) {
      el.classList.add("reveal");
      observer.observe(el);
    });
  }
})();
