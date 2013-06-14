<?if(isset($questions)): foreach ($questions as $question):?>

<p class="well"><?=$question['question_text']?></p>

	<?if(isset($question[0]['answer'])): foreach ($question[0]['answer'] as $answer):?>
		<p><?=$answer?></p>

<?endforeach;endif?>
<?endforeach;endif?>