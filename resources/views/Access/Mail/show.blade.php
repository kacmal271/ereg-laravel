@extends('layouts.mail')

@section('head-final')

  

@endsection

@section('content-final')

  <!-- mail -->
  <div class="single flexbox pv-0">

    <!-- title-wrapper -->
    <div class="single flexbox pv-0">

      <!-- padding -->
      <div class="octal"></div>

      <!-- title -->
      <div class="binary-fill">
        <span class="font-l">{{ $mail->title }}</span>

      </div> <!-- /title -->
    
    </div> <!-- /title-wrapper -->

    <!-- from-date-body-attachment-wrapper -->
    <div class="single flexbox pv-0">

      <!-- img-wrapper -->
      <div class="octal flexbox flexbox-horizontal-right">
        <!-- img -->
        <div>
          <img class="icon-holder-64"
                src="{{ url(config('path.storage.portraitPicture') . $mail->sender->picturePath) }}" />

        </div> <!-- /img -->

      </div> <!-- /img-wrapper -->

      <!-- from-date-body-attachment -->
      <div class="binary-fill flexbox">

        <!-- sender-data -->
        <div class="binary p-0">

          <span class="font-username">
            {{ $mail->sender->fname }}
            {{ $mail->sender->lname }}

          </span>

          <span class="font-s">
            &lt;ID: {{ $mail->sender->id }}&gt;
            {{ __(ucfirst($mail->sender->role->name)) }}
            
          </span>

        </div> <!-- /sender-data -->

        <!-- sent-on -->
        <div class="binary p-0 text-right">
          {{-- date THIS user received THIS mail --}}
          <span class="font-date">{{ $sentOn }} &#40;{{ $sentOnAgo }}&#41;</span>

        </div> <!-- /sent-on -->

        <!-- body -->
        <div class="single p-0 mt-1">
          {{-- Blade {{ <br> }} bricks <br>s --}}
          <span>{!! $mail->body !!}</span>

        </div> <!-- /body -->

        <!-- attachments-wrapper -->
        <div class="single p-0 mt-1 flexbox">

          <div class="single ph-0">
            {{-- Blade {{ <br> }} bricks <br>s --}}
            <span class="text-left font-text-alt font-s">
              {{ __('Attachments') }}: {{ count($mail->attachments) }}
            
            </span>
          
          </div>

          <!-- attachments -->
          <div class="single ph-0">
            @foreach ($attachments as $attachment)

              <a class="hex"
                  href="{{ route('mail.download', ['attachment' => $attachment['id']]) }}"
                  title="{{ $attachment['fileName'] }}">
                <span class="nowrap">{{ $attachment['shortFileName'] }}</span>
              
              </a>

            @endforeach

          </div> <!-- /attachments -->

        </div> <!-- /attachments-wrapper -->

      </div> <!-- /from-date-body-attachment -->
    
    </div> <!-- /from-date-body-attachment-wrapper -->

  </div> <!-- /mail -->

@endsection

