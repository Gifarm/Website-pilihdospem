import "./bootstrap";
import Swal from "sweetalert2";

import { createIcons, icons } from "lucide";

window.lucide = {
    createIcons: () => createIcons({ icons }),
};
window.Swal = Swal;

document.addEventListener("DOMContentLoaded", () => {
    window.lucide.createIcons(); // ✅ sekarang aman
});

import Alpine from "alpinejs";

window.Alpine = Alpine;
Alpine.start();
