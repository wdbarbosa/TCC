<table>
    @foreach($alunos as $aluno)
    </     <tr>
    </         <td>{{ $aluno->user->name }}</td>
    </         <td>
    </             <select name="turma[{{ $aluno->fk_aluno_users_id }}]" required>
    </                 <option value="" disabled>Selecione uma turma</option>
    </                 @foreach($turmas as $turma)
    </                     <option value="{{ $turma->id }}">{{ $turma->nome }}</option>
    </                 @endforeach
    </              </select>
    </          </td>
    </      </tr>
    </  @endforeach
            </table>
