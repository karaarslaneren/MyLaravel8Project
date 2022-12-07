<x-app-layout>
    <x-slot name="header">
        Quiz Stats
    </x-slot>
    <div class="grid grid-cols-2 gap-4">
            <div>
                <form method="GET" action=" ">
                    <div class="mb-2">
                        <input type="text" name="title" placeholder="Quiz Adı" class="form-control" value="{{request()->get('title')}}">
                    </div>
                     @if(request()->get('title'))
                        <div>
                            <a href="{{route('admin.stats')}}" class="btn btn-secondary w-100">Sıfırla</a>
                        </div>
                    @endif
                </form>
            </div>
    </div>
    <div class="grid grid-cols-1">
        <table class="table-auto table-md  text-sm text-left">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Id
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Quiz
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Giren Kişi Sayısı
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Ortalama Puan
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($quizzes as $quiz)
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $quiz->id }}
                        </th>
                        <td class="py-4 px-6">
                            {{ $quiz->title }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $quiz->details['join_count'] ?? '-'}}
                        </td>
                        <td class="py-4 px-6">
                            {{ $quiz->details['average'] ?? '-'}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$quizzes->links()}}
    </div>
</x-app-layout>
