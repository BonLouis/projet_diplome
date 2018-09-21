<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\{ Post };

class AjaxController extends Controller
{
	public function trash(Post $post) {
		$newStatus = $post->status === 'trash' ? 'draft' : 'trash';
		$post->update(['status' => $newStatus]);
		$newCount = Post::trash()->count();
		$msg = [
			'level' => $newStatus === 'draft'
						? 'successMsg'
						: 'errorMsg',
			'html' => $newStatus === 'draft'
						? 'Post n°'.$post->id.' retiré de la corbeille'
						: 'Post n°'.$post->id.' ajouté à la corbeille'
		];
		return compact('newStatus', 'newCount', 'msg');
	}

	public function loadBlankForm() {
		$post = new Post;
		return view('back.edit', compact('post'));
	}

	public function loadOneAndEdit(Post $post) {
		return view('back.edit', compact('post'));
	}

	public function loadTrashes() {
		$posts = Post::trash()->get();
		return view('back.trash', compact('posts'));
	}

	public function untrash(Request $request) {
		if($request->input('some')) {
			$ids = $request->get('ids');
			if($ids) {
				$posts = Post::whereIn('id', $ids);
				$msg = ['successMsg', 'Les posts sélectionnés ne sont plus dans la corbeille'];
			} else {
				$posts = [];
				$msg = ['errorMsg', 'Vous n\'avez pas sélectionné de posts à retirer'];
			}
		} else {
			$posts = Post::trash();
			$msg = ['successMsg', 'Tout les posts ont été retirés de la corbeille'];
		}
		if ($posts)
			$posts->update(['status' => 'draft']);
		$data = json_encode(array(
			'viewModal' => (String)view('back.trash', ['posts' => Post::trash()->get()]),
			'viewTable' => (String)view('back.table', ['posts' => Post::all()]),
			'newCount' => Post::trash()->count(),
			'msg' => [
				'level' => $msg[0],
				'html' => $msg[1]
			]
		));
		return $data;
	}

	public function destroyTrash(Request $request) {
		if($request->input('some')) {
			if($request->input('ids')) {
				$posts = Post::trash()->find($request->input('ids'));
				$msg = ['successMsg', 'Les posts sélectionnés ont bien été supprimés'];
			} else {
				$posts = [];
				$msg = ['errorMsg', 'Vous n\'avez pas sélectionné de posts à supprimer'];
			}
		} else {
			$posts = Post::trash()->get();
			$msg = ['successMsg', 'La corbeille a bien été vidée'];
		}
		foreach($posts as $post) {
			$post->delete();
		}
		$data = json_encode(array(
			'viewModal' => (String)view('back.trash', ['posts' => Post::trash()->get()]),
			'viewTable' => (String)view('back.table', ['posts' => Post::all()]),
			'newCount' => Post::trash()->count(),
			'msg' => [
				'level' => $msg[0],
				'html' => $msg[1]
			]
		));
		return $data;
	}
}
