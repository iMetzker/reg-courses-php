document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const sortSelect = document.getElementById("sortSelect");
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
  
      coursesContainer.innerHTML = "";
      filteredCourses.forEach((course) => coursesContainer.appendChild(course));
    }
  
    searchInput.addEventListener("input", applyFilters);
    sortSelect.addEventListener("change", applyFilters);
  });