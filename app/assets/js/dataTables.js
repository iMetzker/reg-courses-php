new DataTable("#example", {
  layout: {
    topStart: {
      buttons: ["copy", "csv", "excel", "pdf", "print"],
    },
  },
  paging: false,
  searching: false,
});

// ATIVANDO BUTTONS ESCONDIDOS
const excelDTableBtn = document.querySelector(".buttons-excel");
const pdfDTableBtn = document.querySelector(".buttons-pdf");
const printDTableBtn = document.querySelector(".buttons-print");

const orderCourseDTableBtn = document.querySelector(
  ".dt-orderable-asc.dt-orderable-desc"
);
const orderDateDTableBtn = document.querySelector(
  ".dt-type-date.dt-orderable-asc"
);
const orderStatusDTabledBtn = document.querySelector(
  ".status-course.dt-orderable-asc"
);

const excelBtn = document.getElementById("btnExcel");
const pdfBtn = document.getElementById("btnPdf");
const printBtn = document.getElementById("btnPrint");

const courseBtn = document.getElementById("orderCourseBtn");
const dateBtn = document.getElementById("orderDateBtn");
const statusBtn = document.getElementById("orderStatusBtn");

excelBtn.addEventListener("click", function () {
  excelDTableBtn.click();
});

pdfBtn.addEventListener("click", function () {
  pdfDTableBtn.click();
});

printBtn.addEventListener("click", function () {
  printDTableBtn.click();
});

// GARANTINDO APENAS 1 BUTTON COM A CLASSE ACTIVE
function removeActiveClassFromAllButtons() {
    courseBtn.classList.remove("active");
    dateBtn.classList.remove("active");
    statusBtn.classList.remove("active");
  }

courseBtn.addEventListener("click", function () {
  if (!courseBtn.clickCount) {
    courseBtn.clickCount = 0;
  }

  removeActiveClassFromAllButtons();
  orderCourseDTableBtn.click();
  courseBtn.classList.add("active");

  // REMOVENDO A CLASSE ACTIVE APÓS 3 CLIQUES
  courseBtn.clickCount++;
  if (courseBtn.clickCount === 3) {
    courseBtn.classList.remove("active");
    courseBtn.clickCount = 0;
  }
});

dateBtn.addEventListener("click", function () {
  if (!dateBtn.clickCount) {
    dateBtn.clickCount = 0;
  }

  removeActiveClassFromAllButtons();
  orderDateDTableBtn.click();
  dateBtn.classList.add("active");

  dateBtn.clickCount++;
  if (dateBtn.clickCount === 3) {
    dateBtn.classList.remove("active");
    dateBtn.clickCount = 0;
  }
});

statusBtn.addEventListener("click", function () {
  if (!statusBtn.clickCount) {
    statusBtn.clickCount = 0;
  }

  removeActiveClassFromAllButtons();
  orderStatusDTabledBtn.click();
  statusBtn.classList.add("active");

  statusBtn.clickCount++;
  if (statusBtn.clickCount === 3) {
    statusBtn.classList.remove("active");
    statusBtn.clickCount = 0;
  }
});
