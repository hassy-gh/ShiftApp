<h1>管理者登録のお知らせ</h1>
<p>
  {{ $group->name }}の管理者として新規登録されました。<br>
  登録情報は下記の通りです。
</p>
<table>
  <tr>
    <th>管理者ID</th>
    <td>{{ $new_admin->admin_name }}</td>
  </tr>
  <tr>
    <th>氏名（姓）</th>
    <td>{{ $new_admin->last_name }}</td>
  </tr>
  <tr>
    <th>氏名（名）</th>
    <td>{{ $new_admin->first_name }}</td>
  </tr>
  <tr>
    <th>メールアドレス</th>
    <td>{{ $new_admin->email }}</td>
  </tr>
  <tr>
    <th>パスワード</th>
    <td>{{ $password }}</td>
  </tr>
</table>
<div>
  <strong>※パスワードは自動生成されているため、ログイン後に変更してください。</strong>
</div>
<div>
  <a href="{{ route('admin.login') }}">
    管理者としてログインする
  </a>
</div>