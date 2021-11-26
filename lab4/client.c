#include <errno.h>
#include <fcntl.h>
#include <stdbool.h>
#include <stdio.h>
#include <string.h>
#include <sys/stat.h>
#include <sys/types.h>
#include <unistd.h>
#include <stdlib.h>

#define MY_FIFO "/tmp/my_fifo"
#define RES_LEN 64

int main(int argc, char **argv) {
  int fd = 0;

  if ((mkfifo(MY_FIFO, 0666) == -1) && (errno != EEXIST)) {
    printf("%s\n", strerror(errno));
    return -1;
  }

  fd = open(MY_FIFO, O_WRONLY);

  for (int num = 1; num < argc; num++) {
    int len = strlen(argv[num]);

    if ((write(fd, &len, sizeof(len)) < 0) ||
        (write(fd, argv[num], len + 1) < 0)) {
      return -1;
    }
  }
  close(fd);

  fd = open(MY_FIFO, O_RDONLY);

  while (true) {
    int len = 0;
    char *buf = calloc(RES_LEN, sizeof(char));

    read(fd, &len, sizeof(len));
    read(fd, buf, len + 1);

    if (strlen(buf) == 0) {
      free(buf);
      break;
    }

    printf("From server: %s\n", buf);

    free(buf);
  }
  close(fd);

  return 0;
}
