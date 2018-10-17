#!/bin/sh

EXERCISE_REPO=../comem-archidep-vulnerable-php-todo

if ! test -d "$EXERCISE_REPO"; then
  &>2 echo "Exercise repository could not be found at $EXERCISE_REPO"
  exit 1
fi

DIR="$(pwd)"

cd "$EXERCISE_REPO"
BRANCH="$(git rev-parse --abbrev-ref HEAD)"

if [[ "$BRANCH" != "exercise" ]]; then
  &>2 echo "Exercise repository must be on the exercise branch (current branch is $BRANCH)"
  exit 1
fi

cd "$DIR"
cp "$EXERCISE_REPO/index.php" "$EXERCISE_REPO/todolist.sql" .
echo "Copied exercise from $EXERCISE_REPO on branch $BRANCH"
