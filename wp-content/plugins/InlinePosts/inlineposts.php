<?php
	/*
		Plugin Name: Inline Posts
		Plugin URI: http://aralbalkan.com/wordpress/
		Description: Allows you to include posts in pages (and in other posts). To include a post, just enter its ID in square brackets in the body of a page or another post (e.g., [[42]]).
		Version: 2.1.2.g
		Author: Aral Balkan
		Author URI: http://aralbalkan.com
	*/

	//
	// Options/admin panel
	//
	
	add_option('inlineposts_title_tag', 'h2', 'The tag you want the titles of posts to appear in.');
		
	// Add page to options menu.
	function addAdminPage() 
	{
	    // Add a new submenu under Options:
	    add_options_page('Inline Posts Options', 'Inline Posts', 8, 'inlineposts', 'displayAdminPage');
	}

	// Display the admin page.
	function displayAdminPage() 
	{
		
		if (isset($_POST['inlineposts_update'])) 
		{
			check_admin_referer();

			// Update title tag
			$titleTag = $_POST['inlineposts_title_tag'];
			if ($titleTag == '') $titleTag = 'h2';
			update_option(inlineposts_title_tag, $titleTag);

			// echo message updated
			echo "<div class='updated fade'><p>Inline Posts options updated.</p></div>";
		}		
		
		
		?>
		<div class="wrap">
			<h2>Inline Posts Options</h2>
			
			<form method="post">
				<fieldset class='options'>
					<table class="editform" cellspacing="2" cellpadding="5" width="100%">
						<tr>
							<th width="30%" valign="top" style="padding-top: 10px;">
								<label for="inlineposts_title_tag">Title tag:</label>
							</th>
							<td>
								<input type='text' size='16' maxlength='30' name='inlineposts_title_tag' id='inlineposts_title_tag' value='<?= get_option('inlineposts_title_tag'); ?>' />
								The tag you want the titles of posts to appear in.
							</td>
						</tr>
						<tr>
							<td colspan="2">
							<p class="submit"><input type='submit' name='inlineposts_update' value='Update Options' /></p>
							</td>
						</tr>
					</table>
				</fieldset>
			</form>
		</div>
		<?php
	}
	
	//
	// Actual functionality
	//
	
	function includePosts ($content = '') 
	{		
		// Get the Post IDs to include. Post IDs are in the form [nnn].
		preg_match_all('/(?<=\\[\\[)\\d+?(?=\\]\\])/', $content, $matches, PREG_PATTERN_ORDER);
		
		// Create a table of contents for the top of the page.
		$tableOfContents = '<ul>';
		
		$numMatches = count($matches[0]);
		
		for ($i = 0; $i < $numMatches; $i++)
		{
			$titleTag = get_option('inlineposts_title_tag');
			
			$postId = $matches[0][$i];
			$post = get_post($postId);
				
			$anchorTag = '<a name="'.$postId.'" />';
			
			$linkToPost = '<a href="'.get_permalink($postId).'">';	
			$linkToComments = '<a href="'.get_permalink($postId).'#comments">';	
			
			$numComments = get_comments_number($postId);
			$commentsPluralization = ($numComments == 1) ? '':'s';
				
			$lastModifiedText = 'Last modified on '.$post->post_modified_gmt.' GMT.';
			$commentsText = $linkToComments.$numComments.' comment'.$commentsPluralization.'</a>';
			
			$topLink = '<a href="#top">Top</a>';
			
			$postTitle = $post->post_title;
			
			// Update the table of contents
			$tableOfContents .= '<li><a href="#'.$postId.'">'.$postTitle.'</a></li>';
			
			$postTitleText = "<$titleTag>$linkToPost$postTitle</a>$anchorTag</$titleTag>";
			$postBodyText = '<p>'.format_to_post($post->post_content).'</p>';
			
			// Display the edit link next to topic headers if user has edit permissions. 
			$canEdit = false;
			$editLink = '';
			if (current_user_can('edit_page', $postId))
			{
				$file = 'page';		
				$canEdit = true;		
			}
			if (current_user_can('edit_post', $postId))
			{
				$file = 'post';
			}
			
			if (!is_attachment() && $canEdit)  
			{
				$location = get_option('siteurl') . "/wp-admin/{$file}.php?action=edit&amp;post=$postId";
				$editLink = "<a href=\"$location\">Edit topic.</a>";
			}

			$text = $postTitleText.'<small>'.$lastModifiedText.' '.$commentsText.'. '.$topLink.'. '.$editLink."</small>".$postBodyText;
			
			// Remove comments and any line breaks before the tags
			// so that these don't cause Wordpress to insert extra
			// <br /> tags. 
			$content = preg_replace('/<!--.*?-->/', '', $content);
			$content = str_replace("\r\n[[", '[[', $content);

			// Replace the post placeholder with the actual post.
			$content = str_replace("[[$postId]]", $text, $content);
		}
	
		$tableOfContents .= '</ul>';
	
		// Add top anchor
		$content = '<p id="top" />'.$content;
		
		// Add the TOC if user requested it
		$content = str_replace("[[TOC]]", $tableOfContents, $content);
		
		error_log($tableOfContents);
	
	    return $content;
	}

	//
	// Hooks
	//
		
	add_action('admin_menu', 'addAdminPage');
	add_filter('the_content', 'includePosts', 1);
	
	
	
?>