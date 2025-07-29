document.addEventListener("DOMContentLoaded", () => {
    const $boton = document.querySelector("#btnReportePDF");
    $boton.addEventListener("click", () => {
        const $elementoParaConvertir = document.body;
        html2pdf()
            .set({
                margin: 0,
                filename: 'reporte.pdf',
                image: {
                    type: "png",
                    quality: 0.20
                },
                html2canvas: {
                    scale: 1.5,
                    letterRendering: true,
                },
                jsPDF: {
                    Unit: "in",
                    format: "a3",
                    orientation: 'landscape'
                }
            })
            .from($elementoParaConvertir)
            .save()
            .catch(err => console.log(err))
    });
});