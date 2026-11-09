import "tailwindcss";
import "./datatables";
import "./susses";
import "./productos";

import TomSelect from "tom-select";
import "tom-select/dist/css/tom-select.css";

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".tom-select").forEach((element) => {
        new TomSelect(element, {
            create: false,
            maxOptions: 100,
        });
    });
});

new TomSelect(".selectSh", {
    controlInput: null,
    create: false,
    maxItems: 1,
});