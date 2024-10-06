let showSearch = false;
let isFormShown = false;
$(() => {
  $("#search-icon").on("click", () => {
    const searchInput = $("#search-input");
    if (!showSearch) {
      searchInput.css("display", "inline");
      searchInput.animate(
        {
          width: "100%",
        },
        100,
        () => {
          showSearch = true;
          searchInput.focus();
        }
      );
    } else {
      searchInput.animate(
        {
          width: "0%",
        },
        100,
        () => {
          searchInput.css("display", "none");
          showSearch = false;
        }
      );
    }
  });

  $("#add-icon").on("click", () => {
    if (!isFormShown) {
      showForm();
    }
  });

  $("#hide").on("click", () => {
    if (isFormShown) {
      hideForm();
    }
  });


});

function hideForm() {
  const form = $("#form");
  form.animate(
    {
      height: 0,
    },
    200,
    () => {
      form.css("display", "none");
      $("#add-icon").css("display", "inline");
      isFormShown = false;
    }
  );
}

function showForm() {
  const form = $("#form");
  form.css({
    display: "block",
    height: "0px"
  });
  const targetHeight = "187px"; // or calculate dynamically if needed
  form.animate(
    {
      height: targetHeight,
    },
    200,
    () => {
      form.css("height", "auto");
      $("#add-icon").css("display", "none");
      isFormShown = true;
    }
  );
}

