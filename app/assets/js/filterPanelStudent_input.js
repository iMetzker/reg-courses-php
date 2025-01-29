document.addEventListener("DOMContentLoaded", function () {
  const searchInput = document.getElementById("searchInput");
  const coursesContainer = document.getElementById("coursesContainer");
  const courseCards = Array.from(
    coursesContainer.getElementsByClassName("course-card")
  );

  function applyFilters() {
    const searchText = searchInput.value.toLowerCase();

    const filteredCourses = courseCards.filter((course) => {
      const courseName = course
        .querySelector(".heading a")
        .textContent.toLowerCase();
      return courseName.includes(searchText);
    });

    // RESETANDO O CARD E ADICIONANDO APENAS OS CURSOS FILTRADOS
    coursesContainer.innerHTML = "";

    // VERIFICANDO SE NAO HÁ CURSOS
    const noResultsMessage = document.getElementById("noResult");

    if (!filteredCourses.length) {
      noResultsMessage.classList.remove("d-none");
    } else {
      noResultsMessage.classList.add("d-none");

      filteredCourses.forEach((course) => {
        coursesContainer.appendChild(course);
      });
    }
  }

  searchInput.addEventListener("input", applyFilters);
});
