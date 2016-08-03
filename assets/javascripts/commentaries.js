(
	function () {
		var application = angular.module('commentaries', []);

		application.controller('CommentariesController', ['$http', function($http) {
			var blog = this;
			blog.commentaries = [];
			blog.commentForm  = {};

			$http.get('/article/' + article + '/comments').success(function(comments) {
				blog.commentaries = comments;
			});

			blog.postComment = function() {
				var localScope = this;
				$http.post('/comment/leave', {article: article, text: blog.commentForm.text})
					.success(function(comment) {
						blog.commentaries.unshift(comment);
						blog.commentForm = {};
					});
			};
		}]);
	}
)();