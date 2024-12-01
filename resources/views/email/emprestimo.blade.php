{{ $loanInfo['name'] }} seu emprestimo foi realizado como sucesso.

Livro(s): @foreach ($loanInfo['books'] as $book)
{{ $book['title'] }}
@endforeach
