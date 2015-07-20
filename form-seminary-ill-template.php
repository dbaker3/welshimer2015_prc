<?php
/**
Template Name: Seminary ILL Request Form
 */
remove_filter('the_content', 'wpautop'); // Keeps WP from adding the annoying <p> and <br /> tags to content

?>

<?php

	//If the form is submitted
	if(isset($_POST['submit'])) {
	
	//Check the honeypot
		if(trim($_POST['laylah']) !== '') {
			$honeypotError = 'You may not be human, please try again.';
			$hasError = true;
		}
	//Check to make sure that the firstname field is not empty
		if(trim($_POST['patron_firstname']) === '') {
			$firstNameError = 'You must enter your first name.';
			$hasError = true;
		} else {
			$patron_firstname = trim($_POST['patron_firstname']);
		}
	//Check to make sure that the lastname field is not empty
		if(trim($_POST['patron_lastname']) === '') {
			$lastNameError = 'You must enter your last name.';
			$hasError = true;
		} else {
			$patron_lastname = trim($_POST['patron_lastname']);
		}	
	//Check to make sure sure that a valid email address is submitted
		if(trim($_POST['patron_email']) === '') {
			$emailError = 'You must enter your email address.';
			$hasError = true;
		} else if (!eregi("^[a-z0-9._%-]*@.*milligan\.edu$", strtolower(trim($_POST['patron_email'])))) {
			$emailError = 'You must enter a valid Milligan email address.';
			$hasError = true;
		} else {
			$patron_email = strtolower(trim($_POST['patron_email']));
		}
	// Get phone
		$patron_phone = trim($_POST['patron_phone']);

	// Confirm seminary patron
		if(trim($_POST['patron_confirm']) === ''){
			$confirmError = 'You must confirm that you are a Seminary student or faculty member.<br>Non-seminary patrons, please request materials through <a href="http://milligan.on.worldcat.org/advancedsearch/" target="_blank">WorldCat</a>';
			$hasError = true;
		} else {
			$patron_confirm = true;
		}

	//Check to make sure that the title field is not empty
		if(trim($_POST['article_title']) === '') {
			$titleError = 'You must enter the title.';
			$hasError = true;
		} else {
			$article_title = trim($_POST['article_title']);
		}
	//Check to make sure that the author field is not empty
		if(trim($_POST['article_author']) === '') {
			$authorError = 'You must enter an author.';
			$hasError = true;
		} else {
			$article_author = trim($_POST['article_author']);
		}

	// Get publisher
		if (isset($_POST['publisher'])) $publisher = trim($_POST['publisher']);

	//Check to make sure that the date field is not empty
		if(trim($_POST['journal_date']) === '') {
			$dateError = 'You must enter a publication date.';
			$hasError = true;
		} else {
			$journal_date = trim($_POST['journal_date']);
		}
	//Autofill entered ISSN
		$isbn = trim($_POST['isbn']);

	//Added validation structure to messge field, in case it will ever be required
		if(trim($_POST['patron_message']) === '') {
			$patron_message = trim($_POST['patron_message']);
		} else {
			$patron_message = trim($_POST['patron_message']);
		}

		if(!isset($hasError)) {
        // email request to ILL account
	    	$emailTo = 'SEArndt@milligan.edu,JMWade@milligan.edu';
	    	
			$subject = 'Interlibrary Loan Request';
			$body = '<h4>ILL Request made ' . date("F j, Y, g:i a") .'</h4>';
				$body .= '<p><strong>First Name: </strong>' . $patron_firstname  . '</p>';
				$body .= '<p><strong>Last Name: </strong>' . $patron_lastname  . '</p>';
				$body .= '<p><strong>Email: </strong>' . $patron_email . '</p>';
				$body .= '<p><strong>Phone: </strong>' . $patron_phone . '</p>';
				$body .= '<p><strong>Title: </strong>' . $article_title . '</p>';
				$body .= '<p><strong>Author: </strong>' . $article_author . '</p>';
				$body .= '<p><strong>Publisher: </strong>' . $publisher . '</p>';
				$body .= '<p><strong>Date: </strong>' . $journal_date . '</p>';
				$body .= '<p><strong>ISBN: </strong>' . $isbn . '</p>';
				$body .= '<p><strong>Special Instructions: </strong></p><p>' . $patron_message . '</p>';
			$headers[] = 'From: ILL Webform <mc_ill@milligan.edu>';
			$headers[] = 'Reply-To: ' . $patron_email;
			$headers[] = 'content-type: text/html';
			wp_mail( $emailTo, $subject, $body, $headers );
         
         // email confirmation to patron
         $emailTo = $patron_email;
         $subject = 'Interlibrary Loan Request Confirmation';
         $headers = '';
         $headers[] = 'From: ILL Webform <mc_ill@milligan.edu>';
			$headers[] = 'Reply-To: mc_ill@milligan.edu';
			$headers[] = 'content-type: text/html';
         wp_mail( $emailTo, $subject, $body, $headers );
			
			$emailSent = true;
			}
	} ?>

<?php get_header(); ?>

		<div id="primary" class="site-content">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('body-text'); ?>>
						<header class="entry-header">
							<h1 class="entry-title"><?php the_title(); ?></h1>
						</header><!-- .entry-header -->

						<div class="entry-content welshimer-form">
							<?php the_content(); ?>

								<?php if(isset($emailSent) && $emailSent == true): ?>

									<div class="alert success">
										<p>Your ILL request has been successfully submitted. You will be notified via email when your material is available. Any additional questions or comments should be directed to Sarah Arndt, User and Technical Services Coordinator, at <a href="mailto:SEArndt@milligan.edu">SEArndt@milligan.edu</a> or 423-461-1540.</p>
										<p><a class="submit full"href="<?php the_permalink() ?>">Submit Another Request</a>
										</div>

								<?php else: ?>
									<?php if(isset($hasError)): ?>
									<div class="alert fail">
										<?php if(isset($honeypotError)){echo $honeypotError . '<br />';}?>
										<?php if(isset($firstNameError)){echo $firstNameError . '<br />';}?>
										<?php if(isset($lastNameError)){echo $lastNameError . '<br />';}?>
										<?php if(isset($emailError)){echo $emailError . '<br />';}?>
										<?php if(isset($confirmError)){echo $confirmError . '<br />';}?>
										<?php if(isset($titleError)){echo $titleError . '<br />';}?>
										<?php if(isset($authorError)){echo $authorError . '<br />';}?>
										<?php if(isset($dateError)){echo $dateError . '<br />';}?>
									</div>
								<?php else: ?>
									<div class="alert info"><p>Please complete all required fields and citation information. If not available, please indicate N/A in the field. Complete all contact information including your Milligan College email address. Thank you!</p>
									</div>

									<?php endif; ?>
									<!--ILL Form -->
									<form action="<?php the_permalink(); ?>" method="post">
										<h3>Patron Information</h3>
										<p class="form"><label class="label" for="patron_firstname">First Name:* </label><input tabindex="1" class="text half<?php if(isset($firstNameError)){echo ' fail';}?>" type="text" id="patron_firstname" name="patron_firstname" value="<?php if(isset($patron_firstname)){echo $patron_firstname;} ?>"/></p>
										<p class="form"><label class="label" for="patron_lastname">Last Name:* </label><input tabindex="2" class="text half<?php if(isset($lastNameError)){echo ' fail';}?>" type="text" id="patron_lastname" name="patron_lastname" value="<?php if(isset($patron_lastname)){echo $patron_lastname;} ?>"/></p>
										<p class="form"><label class="label" for="patron_email">Milligan Email:* </label><input tabindex="3" class="text three-fourths<?php if(isset($emailError)){echo ' fail';}?>" type="text" id="patron_email" name="patron_email" value="<?php if(isset($patron_email)){echo $patron_email;} ?>" /></p>
										<p class="form"><label class="label" for="patron_phone">Phone: </label><input tabindex="4" class="text half" type="text" id="patron_phone" name="patron_phone" value="<?php if (isset($patron_phone)){echo $patron_phone;} ?>" /></p>
										<p class="form"><input type="checkbox" id="patron_confirm" name="patron_confirm" tabindex="5" value="patron_confirm" <?php if (isset($patron_confirm)){echo 'checked';}?>> <label class="<?php if (isset($confirmError)){echo 'fail';}?>" for="patron_confirm">I confirm that I am a Seminary Student or Faculty member</label></p>
										<h3>Requested Item Information</h3>
										<p class="form"><label class="label" for="article_title">Title:* </label><input tabindex="6" class="text<?php if(isset($titleError)){echo ' fail';}?>" type="text" id="article_title" name="article_title" value="<?php if(isset($article_title)){echo $article_title;} ?>" /></p>
										<p class="form"><label class="label" for="article_author">Author:* </label><input tabindex="7" class="text<?php if(isset($authorError)){echo ' fail';}?>" type="text" id="article_author" name="article_author" value="<?php if(isset($article_author)){echo $article_author;} ?>" /></p>
										<p class="laylah"><label for="laylah">Required</label><input type="text" id="laylah" name="laylah" tabindex="999" /></p>
										<p class="form"><label class="label" for="journal_date">Publication Date:* </label><input tabindex="8" class="text half<?php if(isset($dateError)){echo ' fail';}?>" type="text" id="journal_date" name="journal_date" value="<?php if(isset($journal_date)){echo $journal_date;} ?>" /></p>
										<p class="form"><label class="label" for="publisher">Publisher: </label><input tabindex="9" class="text half" type="text" id="publisher" name="publisher" value="<?php if(isset($publisher)){echo $publisher;} ?>" /></p>
										<p class="form"><label class="label" for="isbn">ISBN: </label><input class="text half" type="text" id="isbn" name="isbn" tabindex="10" value="<?php if(isset($isbn)){echo $isbn;} ?>" /></p>
										<p class="form"><label class="label" for="patron_message">Special Instructions: </label><textarea tabindex="11" class="textarea" id="patron_message" name="patron_message" ><?php if(isset($patron_message)){echo $patron_message;} ?></textarea></p>
										<p class="form"><input class="submit full" type="submit" name="submit" value="Send Request" tabindex="12" ></p>
									</form>
								<?php endif; ?>



							<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'welshimer2013' ), 'after' => '</div>' ) ); ?>
							<?php edit_post_link( __( 'Edit', 'welshimer2013' ), '<div><span class="edit-link">', '</span></div>' ); ?>
						</div><!-- .entry-content -->
					</article><!-- #post-<?php the_ID(); ?> -->
				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary .site-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>