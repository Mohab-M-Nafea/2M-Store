document.querySelector('.stars').addEventListener('click', fav);

function fav(e) {
  const tgt = e.target.firstElementChild;
  tgt.classList.toggle('fa-star active');
  tgt.classList.toggle('fa-star');
}
// $('.stars .fa-star').on('click', jQFav);
// function jQFav(e) {
//   $(this).find('.fa-star').toggleClass('fa-star active');
// }

// document.querySelector('.stars .fa-star').addEventListener('click', JSFav);
// function JSFav(e) {
//   const tgt = e.target.firstElementChild;
//   tgt.classList.toggle('fa-star active');
//   tgt.classList.toggle('fa-star');
// }
// var stars;

// document.addEventListener('DOMContentLoaded', function () {
//       $('.stars').on('click', '[data-fa-i2svg]', function () {
//         alert('You clicked the icon itself');
//       });
//     });

// document.addEventListener('DOMContentLoaded', function () {
//       $('.stars').on('click', function () {
//         $(this)
//           .find('[data-fa-i2svg]')
//           .toggleClass('fa-star active')
//           .toggleClass('fa-star');
//       });
//     });


// document.addEventListener('DOMContentLoaded', function () {
//     $(document).on('load', function () {
//     const stars = document.querySelectorAll('.stars .fa-star');
//     console.log(stars)
//     stars.forEach((star, index1) => {
//         star.addEventListener("click", () => {
//             stars.forEach((star, index2) => {
//                 index1 >= index2 ? star.classList.add("active") : star.classList.remove("active");
//             })
//         })
//     })
// });
// });

// document.addEventListener('DOMContentLoaded', function () {
//     $('.stars [data-fa-i2svg]').forEach((star, index) => {
//           console.log(index)
//       })
//     });

// .on('click', '[data-fa-i2svg]', function () {
//           console.log(index);
//       });