<x-app-layout>
    @include('sweetalert::alert')
	<x-slot name="header">Quiz Güncelle</x-slot>
    <div class="grid grid-cols-1 text-center">
        <form method="POST" action="{{route('quizzes.update',$quiz->id)}}">
            @method('PUT')
            @csrf
            <div class="mb-6">
                <div class="w-full px-3 mb-6">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Quiz Başlığı</label> 
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    type="text" name="title" value="{{$quiz->title}}">
                </div>
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Quiz Açıklama</label> 
                    <textarea name="description" rows="4" class="w-full bg-gray-200">{{$quiz->description}}
                    </textarea>
                </div>
            </div>
            <div class="mb-6 w-full">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Quiz Durumu</label>
                    <div class="grid grid-cols-3">
                        <div class="items-center">
                            <input id="default-radio-1" type="radio" @if($quiz->questions_count<4)disabled @endif @if($quiz->status==='publish')checked @endif value="publish" name="status" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="default-radio-1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Aktif</label>
                        </div>
                        <div class="items-center">
                            <input checked id="default-radio-2" type="radio" @if($quiz->status==='passive')checked @endif value="passive" name="status" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="default-radio-2" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Pasif</label>
                        </div>
                        <div class="items-center">
                            <input checked id="default-radio-2" type="radio" @if($quiz->status==='draft')selected @endif value="draft" name="status" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="default-radio-2" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Taslak</label>
                        </div>     
                    </div>
                                       
                </div>
            </div>
            <div class="mb-6">
                <div class="w-full px-3">
                    <input id="isFinished"@if($quiz->finished_at) checked @endif type="checkbox">
                        <label>Bitiş Tarihi Olacak mı?</label>
                </div>
                <div id="finishedInput" @if(!$quiz->finished_at) style="display: none;" @endif class="w-full px-3">
                    <div class="inline-block w-64">
                        <label>Bitiş Tarihi</label>
                        <input type="datetime-local" name="finished_at" class="form-control" value="{{$quiz->finished_at}}">
                    </div>
                </div>
            </div>
            <div>
                <button class="text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 w-full"> Quiz Güncelle</button>
            </div>
        </form>
    </div>
    <x-slot name="js">
    	<script>
    		$('#isFinished').change(function()
    		{
               if($('#isFinished').is(':checked'))
               {
               	$('#finishedInput').show();
               }else{
               	$('#finishedInput').hide();
               }
            })
        </script>
    </x-slot>
</x-app-layout>	