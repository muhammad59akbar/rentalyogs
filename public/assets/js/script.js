function changeImage(input, previewId) {
    const prevImage = document.getElementById(previewId); // Mendapatkan elemen gambar berdasarkan ID

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            prevImage.src = e.target.result; // Mengupdate src elemen gambar dengan hasil dari file yang dipilih
        }
        reader.readAsDataURL(input.files[0]); // Membaca file dan mengonversinya menjadi URL data
    }
}

  




