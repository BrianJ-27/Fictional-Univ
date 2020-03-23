/* eslint-disable linebreak-style */
/* eslint-disable no-unused-vars */
/* eslint-disable max-len */
/* eslint-disable require-jsdoc */
import $ from 'jquery';

class Like {
  constructor() {
    this.events();
  }


  events() {
    $('.like-box').on('click', this.ourClickDispatcher.bind(this) );
  }

  // Methods will be here
  ourClickDispatcher(e) {
    const currentLikeBox = $(e.target).closest('.like-box');

    if (currentLikeBox.attr('data-exists') == 'yes') {
      this.deleteLike(currentLikeBox);
    } else {
      this.createLike(currentLikeBox);
    }
  }

  createLike(currentLikeBox) {
    $.ajax({
      // look up what nonce does
      beforeSend: (xhr) => {
        xhr.setRequestHeader('X-WP-Nonce', univData.nonce);
      },
      url: univData.root_url + '/wp-json/university/v1/manageLike',
      type: 'POST',
      // adding data property like this is the same as adding on additional info to the endpoint ex) /wp-json/university/v1/manageLike?professorId=789
      data: {'professorId': currentLikeBox.data('professor')},
      success: (response) =>{
        // code to fill in the heart with css
        currentLikeBox.attr('data-exists', 'yes');
        // create variable to hold the like count
        let likeCount = parseInt(currentLikeBox.find('.like-count').html(), 10);
        // update like count by 1
        likeCount++;
        // outputing the like count number onto the page
        currentLikeBox.find('.like-count').html(likeCount);
        // will set and return the relative id value
        currentLikeBox.attr('data-like', response);
        console.log(response);
      },
      error: (response) => {
        console.log(response);
      },
    });
  }

  deleteLike(currentLikeBox) {
    $.ajax({
      beforeSend: (xhr) => {
        xhr.setRequestHeader('X-WP-Nonce', univData.nonce);
      },
      url: univData.root_url + '/wp-json/university/v1/manageLike',
      data: {'like': currentLikeBox.attr('data-like')},
      type: 'DELETE',
      success: (response) => {
        // code to fill in the heart with css
        currentLikeBox.attr('data-exists', 'no');
        // create variable to hold the like count
        let likeCount = parseInt(currentLikeBox.find('.like-count').html(), 10);
        // subtract like count by 1
        likeCount--;
        // outputing the like count number onto the page
        currentLikeBox.find('.like-count').html(likeCount);
        // will set and return the relative id value
        currentLikeBox.attr('data-like', '');
        console.log(response);
      },
      error: (response) => {
        console.log(response);
      },
    });
  }
}

export default Like;
