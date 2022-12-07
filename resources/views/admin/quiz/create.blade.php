<x-app-layout>
    @include('sweetalert::alert')
	<x-slot name="header">Quiz Oluştur</x-slot>
    <div class="flex flex-md-column text-center">
        <form method="POST" action="{{route('quizzes.store')}}">
            @csrf
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Quiz Başlığı</label> <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    type="text" value="{{old('title')}}">
                </div>
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Quiz Açıklama</label> 
                    <textarea name="description" rows="4" class="w-full bg-gray-200">{{old('description')}}
                    </textarea>
                </div>
            </div>
            <div class="flex -mx-3 mb-6">
                <div class="w-full px-3">
                    <input id="isFinished"@if(old('finished_at')) checked @endif type="checkbox">
                        <label>Bitiş Tarihi Olacak mı?</label>
                </div>
                <div id="finishedInput" @if(!old('finished_at')) style="display: none;" @endif class="w-full px-3">
                    <div class="inline-block relative w-64">
                        <label>Bitiş Tarihi</label>
                        <input type="datetime-local" name="finished_at" class="form-control" value="{{old('finished_at')}}">
                    </div>
                </div>
            </div>
            <div>
                <button class="text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 w-full"> Quiz Oluştur</button>
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
            $('#soruEkle').change(function()
            {
               if($('#soruEkle').is(':checked'))
               {
                $('#soruInput').show();
               }else{
                $('#soruInput').hide();
               }
            })
        </script>
    </x-slot>
</x-app-layout>	