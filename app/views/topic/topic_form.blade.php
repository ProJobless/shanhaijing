@extends('layouts.master')

@section('vendor-styles')
  @parent
  {{ HTML::style('vendor/pagedown/pagedown.css') }}
@stop

@section('content')
<section>
<h1><?php echo isset($topic) ? 'Edit topic: ' . e($topic->title) : 'Create Topic'; ?></h1>
<?php echo Form::open(array(
  'url' => isset($topic) ? 'topic/' . $topic->id : 'topic',
  'method' => isset($topic) ? 'PUT' : 'POST',
)); ?>
  <div class="controls">
    <?php echo Form::text('title', isset($topic) ? $topic->title : '', array(
      'placeholder' => 'Type topic title here.', 'class' => 'span5')); ?>
    <div class="wmd-panel">
      <div id="wmd-button-bar"></div>
      <?php echo Form::textarea('body', isset($post) ? $post->body : '', array(
        'placeholder' => 'Type topic body here.', 
        'class' => 'span9', 
        'id' => 'wmd-input')); ?>
    </div>
  </div>

  <div class="form-actions">
    <button type="submit" class="btn btn-primary">
      <?php echo isset($topic) ? 'Save' : 'Create Topic'; ?></button>
  </div>
<?php echo Form::close(); ?>
</section>
@stop

@section('scripts')
  @parent
  <?php echo HTML::script('vendor/pagedown/Markdown.Converter.js'); ?>
  <?php echo HTML::script('vendor/pagedown/Markdown.Sanitizer.js'); ?>
  <?php echo HTML::script('vendor/pagedown/Markdown.Editor.js'); ?>
  <script type="text/javascript">
  (function() {
    var converter = Markdown.getSanitizingConverter();
    var editor = new Markdown.Editor(converter);
    editor.run();
  })();
  </script>
@stop
